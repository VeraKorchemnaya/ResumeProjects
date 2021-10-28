<!-- 
    Name: Vera Korchemnaya
    Date: 10-21-21
    Description: When a user hits submit on the index.html page it will
        be submitted to this document. 
         - print amortization schedule for the life of the loan
         - can compare the interest between terms if selected
         - print user info 
         - validate that user info is not empty
 -->

<?php

# This function is almost exact to the one developed by Clay Breshears.
# Clay Breshears cbreshears1@ewu.edu myform_check2.php 
# Given 10-14-21 as part of the lecture on php form checking.
function checkData($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && empty($data)){
        die($problem);
    }
    return $data;
}

# Verify that all variables are valid using the method above
$borrower = checkData($_POST['borrower'], "Please enter the borrower's name.");
$street = checkData($_POST['street'], "Please enter your street.");
$city = checkData($_POST['city'], "Please enter your city.");
$state = checkData($_POST['state'], "Please enter your state.");
$zipCode = checkData($_POST['zipCode'], "Please enter your zipcode.");
$propertyType    = checkData($_POST['propertyType'], "Please enter the property type.");
$loanAmount   = checkData($_POST['loanAmount'], "Please enter the loan amount.");
$interestRate = checkData($_POST['interestRate'], "Please select interest rate.");
$loanYears = checkData($_POST['loanYears'], "Please enter the loan year.");
$reportFormat = checkData($_POST['reportFormat'], "Please select a report format.");

# Calculate the monthly payment
$monthlyRate = ($interestRate/100)/12; // Convert to decimal form and divide by 12 months
$monthNum = $loanYears * 12; // Multiply by 12 months
$monthlyPayment = $loanAmount * ($monthlyRate * pow(1 + $monthlyRate, $monthNum))/(pow(1 + $monthlyRate, $monthNum) - 1);

# Storing all the necessary information in one place will make it a lot easier to pass arround
$loanInfo = array('loanAmount' => $loanAmount, 'loanYears' => $loanYears, 'monthlyRate' => $monthlyRate, 'monthlyPayment' => $monthlyPayment, 'reportFormat' => $reportFormat);


# Main function logic
function printSchedule($loanInfo)
{
    if($loanInfo['loanYears'] == -1){
        compareSchedule($loanInfo);
    } elseif($loanInfo['reportFormat'] == 'month'){
        printMonthlySchedule($loanInfo);
    } elseif($loanInfo['reportFormat'] == 'year'){
        printAnnualSchedule($loanInfo);
    }
}

# Runs if the user selected to compare the total interest for different terms
function compareSchedule($loanInfo)
{
    $diffLoanYears = array(5, 10, 15, 20, 30);

    # We will iterate over every element in the array above
    for($i = 0; $i < count($diffLoanYears); ++$i){
        $loanInfo['loanYears'] = $diffLoanYears[$i];

        # We need to update the monthlyPayment to accurately represent the term
        $monthNum = $loanInfo['loanYears'] * 12; // Multiply by 12 months
        $loanInfo['monthlyPayment'] = $loanInfo['loanAmount'] * ($loanInfo['monthlyRate'] * pow(1 + $loanInfo['monthlyRate'], $monthNum))/(pow(1 + $loanInfo['monthlyRate'], $monthNum) - 1);

        # Create storage array
        $monthStats = array('principalOwed' => $loanInfo['loanAmount'], 'interestPaid' => 0, 'principalPaid' => 0, 'remainingPrincipal' => $loanInfo['loanAmount'], 'totalInterest' => 0);

        # Will calculate total interest over the term
        for($j = 0; $j < $loanInfo['loanYears'] * 12; ++$j){
            $monthStats = calcMonthlyStats($monthStats, $loanInfo);
        }

        # Printing the interest
        echo "<tr>
        <td>" . $loanInfo['loanYears'] . "</td>
        <td colspan='4'>$" . number_format($monthStats['totalInterest'], 2, ".", ",") . "</td>
        </tr>";

    }
}

# Runs if the user selected to see the schedule by months
function printMonthlySchedule($loanInfo)
{
     # Create storage array
    $monthStats = array('principalOwed' => $loanInfo['loanAmount'], 'interestPaid' => 0, 'principalPaid' => 0, 'remainingPrincipal' => $loanInfo['loanAmount'], 'totalInterest' => 0);

    # Will print the data for every month
    for($i = 1; $i <= $loanInfo['loanYears'] * 12; ++$i){
        $monthStats = calcMonthlyStats($monthStats, $loanInfo);
        echo "<tr>
        <td>" . $i . "</td>
        <td>$" . number_format($monthStats['principalOwed'], 2, ".", ",") . "</td>
        <td>$" . number_format($monthStats['interestPaid'], 2, ".", ",") . "</td>
        <td>$" . number_format($monthStats['principalPaid'], 2, ".", ",") . "</td>
        <td>$" . number_format($monthStats['remainingPrincipal'], 2, ".", ",") . "</td>
        </tr>";
    }

    # Print total interest and calculate what percetage of the total paid was interest
    $paymentPercentage = ($monthStats["totalInterest"] / ($monthStats["totalInterest"] + $loanInfo['loanAmount'])) * 100;
    echo "<tr> <td colspan='5' style='text-align:left'>Total interest paid:      $" . number_format($monthStats['totalInterest'], 2, ".", ",")
     . " (" . number_format($paymentPercentage, 1, ".", ",") . "% of payments)</td></tr>";
}

function printAnnualSchedule($loanInfo)
{
     # Create storage array
    $monthStats = array('principalOwed' => $loanInfo['loanAmount'], 'interestPaid' => 0, 'principalPaid' => 0, 'remainingPrincipal' => $loanInfo['loanAmount'], 'totalInterest' => 0);
    $years = 1;

    while($years <= $loanInfo['loanYears']){
        # Extra variables needed to properly print yearly amortization schedule
        $originalPrincipalOwed = $monthStats['remainingPrincipal'];
        $annualInterestPaid = 0;
        $annualPrincipalPaid = 0;

        # Will calculate data for each year
        for($i = 0; $i < 12; ++$i){
            $monthStats = calcMonthlyStats($monthStats, $loanInfo);
            $annualInterestPaid += $monthStats['interestPaid'];
            $annualPrincipalPaid += $monthStats['principalPaid'];
        }

        echo "<tr>
        <td>" . $years . "</td>
        <td>$" . number_format($originalPrincipalOwed, 2, ".", ",") . "</td>
        <td>$" . number_format($annualInterestPaid, 2, ".", ",") . "</td>
        <td>$" . number_format($annualPrincipalPaid, 2, ".", ",") . "</td>
        <td>$" . number_format($monthStats['remainingPrincipal'], 2, ".", ",") . "</td>
        </tr>";
        ++$years;
    }

    # Print total interest and calculate what percetage of the total paid was interest
    $paymentPercentage = ($monthStats["totalInterest"] / ($monthStats["totalInterest"] + $loanInfo['loanAmount'])) * 100;
    echo "<tr> <td colspan='5' style='text-align:left'>Total interest paid:      $" . number_format($monthStats['totalInterest'], 2, ".", ",")
     . " (" . number_format($paymentPercentage, 1, ".", ",") . "% of payments)</td></tr>";
}

# This function is the backbone of all schedule-printing functions
function calcMonthlyStats($prevMonthlyStats, $loanInfo){
    # Calculates principal owed, interest paid, principal paid, remaining principal, and total interest
    # It uses the previous month data and the loan data that is passed in
    $currentMonth = array('principalOwed' => $prevMonthlyStats['remainingPrincipal']);
    $currentMonth['interestPaid'] = $currentMonth['principalOwed'] * $loanInfo['monthlyRate'];
    $currentMonth['principalPaid'] = $loanInfo['monthlyPayment'] - $currentMonth['interestPaid'];
    $currentMonth['remainingPrincipal'] = $currentMonth['principalOwed'] - $currentMonth['principalPaid'];
    $currentMonth['totalInterest'] =  $prevMonthlyStats['totalInterest'] + $currentMonth['interestPaid'];

    # Returns all the data for that month
    return $currentMonth;
}

?>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form</title>
    <link rel="stylesheet" href="style.css" />
  </head>
    <body>
        
        <?php echo $borrower;?> <br>
        <?php echo $street;?> <br>
        <?php echo $city . ',' . ' ' . $state . ' ' . $zipCode?> <br><br>

        Property: <?php echo $propertyType;?> <br>   
        Total Loan: $<?php echo number_format($loanAmount, 0, "", ",");?>
        Term:
        <?php if($loanYears == "-1"){
            echo "Compare terms";
        } else if ($reportFormat == "month"){
            echo $loanYears * 12 . " months";
        } else {
            echo $loanYears . " years";
        } ?> <br>  
        Interest rate: <?php echo $interestRate . '%' ?> <br>

        <!-- If the compare terms option is selected then monthly payment is not displayed -->
        <?php if($loanYears == "-1"){
        } else { ?>
            Monthly payment: $<?php echo number_format($monthlyPayment, 2, ".", ",");?><br>
        <?php }?>
         
        <!-- Amortization Schedule -->
        <table>
            <?php
                if($loanYears == "-1"){
                    echo "<tr>
                    <th>Terms</th>
                    <th>Total Interest Paid</th>
                    </tr>";
                } else {
                    $display = $reportFormat == "year" ? "Year" : "Month";
                    echo "<tr>
                    <th>" . $display ."</th>
                    <th>Principal Owed</th>
                    <th>Interst Paid</th>
                    <th>Principal Paid</th>
                    <th>Remaining Principal</th>
                    </tr>";
                }

                # Main function call ***
                printSchedule($loanInfo);
             ?>
        </table>
    </body>
</html>
