<!-- 
    Name: Vera Korchemnaya
    Description: Form layout
        - This form layout is used in edit.blade.php and 
          create.blade.php.
        - The form will remember previous data.
 -->

<!-- 
    The form method and action are left to the user to implement
 -->

<!-- TITLE -->
<div class="form-group">
    <div class="col-3 col-sm-12">
        <label class="form-label" for="title">Title</label>
    </div>
    <div class="col-9 col-sm-12">
        <input class="form-input" type="text" maxlength="30" id="title" name="title" placeholder="Title" value="{{old('title', $comic->title)}}">
    </div>
</div>

<!-- VOLUME -->
<div class="form-group">
    <div class="col-3 col-sm-12">
        <label class="form-label" for="volume">Volume</label>
    </div>
    <div class="col-9 col-sm-12">
        <input class="form-input" type="number" id="volume" name="volume" placeholder="Volume Number" min="1" max="2021" value="{{old('volume', $comic->volume)}}">
    </div>
</div>

<!-- ISSUE NUMBER -->
<div class="form-group">
    <div class="col-3 col-sm-12">
        <label class="form-label" for="issue_number">Issue Number</label>
    </div>
    <div class="col-9 col-sm-12">
        <input class="form-input" type="number" id="issue_number" name="issue_number" placeholder="Issue Number" min="1" max="100" value="{{old('issue_number', $comic->issue_number)}}">
    </div>
</div>

<!-- MONTH -->
<div class="form-group">
    <div class="col-3 col-sm-12">
        <label class="form-label" for="month">Month</label>
    </div>
    <div class="col-9 col-sm-12">
        <select class="form-select" id="month" name="month" size="4">
            <!-- php is used to display the correct months to the user -->
            @php
            $months = array('December', 'November', 'October', 'September', 'August', 'July', 'June', 'May', 'April', 'March', 'February', 'January');
            @endphp

            <!-- Month is stored as a number in the database. Range from Dec (1) to Jan (12) -->
            @foreach (range(12, 1) as $month_index)
            <option value="{{$month_index}}" {{$month_index == old('month', $comic->month) ? 'selected' : '' }}>{{$months[$month_index - 1]}}</option>
            @endforeach
        </select>
    </div>
</div>

<!-- YEAR -->
<div class="form-group">
    <div class="col-3 col-sm-12">
        <label class="form-label" for="year">Year</label>
    </div>
    <div class="col-9 col-sm-12">
        <select class="form-select" id="year" name="year" size="4">
            <!-- Used a foreach loop so we don't need to write each year out -->
            @foreach (range(2021, 1837) as $pub_year)
            <option value={{$pub_year}} {{$pub_year == old('year', $comic->year) ? 'selected' : '' }}>{{$pub_year}}</option>
            @endforeach
        </select>
    </div>
</div>

<!-- CONDITION -->
<div class="form-group">
    <div class="col-3 col-sm-12">
        <label class="form-label" for="condition">Condition</label>
    </div>
    <div class="col-9 col-sm-12">
        <select class="form-select" id="condition" name="condition" size="4">
            <!-- php is used to display the correct condition to the user -->
            @php
            $conditions = array('Poor (PO)', 'Fair (FA)', 'Good (GD)', 'Very Good (VG)', 'Fine (FN)', 'Very Fine (VF)', 'Near Mint (NM)', 'Mint (MT)');
            @endphp

            <!-- Condition is stored as a number in the database. Range from Poor (1) to Mint (8) -->
            @foreach (range(8, 1) as $condition_index)
            <option value="{{$condition_index}}" {{$condition_index == old('condition', $comic->condition) ? 'selected' : '' }}>{{$conditions[$condition_index - 1]}}</option>
            @endforeach

        </select>
    </div>
</div>

<!-- WRITER LAST NAME -->
<div class="form-group">
    <div class="col-3 col-sm-12">
        <label class="form-label" for="writer_last_name">Writer Last Name</label>
    </div>
    <div class="col-9 col-sm-12">
        <input class="form-input" type="text" id="writer_last_name" maxlength="20" name="writer_last_name" placeholder="Last Name" value="{{old('writer_last_name', $comic->writer_last_name)}}">
    </div>
</div>

<!-- WRITER FIRST NAME -->
<div class="form-group">
    <div class="col-3 col-sm-12">
        <label class="form-label" for="writer_first_name">Writer First Name</label>
    </div>
    <div class="col-9 col-sm-12">
        <input class="form-input" type="text" id="writer_first_name" maxlength="20" name="writer_first_name" placeholder="First Name" value="{{old('writer_first_name', $comic->writer_first_name)}}">
    </div>
</div>

<!-- ARTIST LAST NAME -->
<div class="form-group">
    <div class="col-3 col-sm-12">
        <label class="form-label" for="artist_last_name">Artist Last Name</label>
    </div>
    <div class="col-9 col-sm-12">
        <input class="form-input" type="text" id="artist_last_name" maxlength="20" name="artist_last_name" placeholder="Last Name" value="{{old('artist_last_name', $comic->artist_last_name)}}">
    </div>
</div>

<!-- ARTIST FIRST NAME -->
<div class="form-group">
    <div class="col-3 col-sm-12">
        <label class="form-label" for="artist_first_name">Artist First Name</label>
    </div>
    <div class="col-9 col-sm-12">
        <input class="form-input" type="text" id="artist_first_name" maxlength="20" name="artist_first_name" placeholder="First Name" value="{{old('artist_first_name', $comic->artist_first_name)}}">
    </div>
</div>

<br>

<!-- 
    The sumbit button is left to the user to implement
 -->