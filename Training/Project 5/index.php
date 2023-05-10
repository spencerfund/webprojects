<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="form_holder">
        <h1>Sign Up Form</h1>
        <form action="form.php" method="post">
            <label for="firstName">First Name:</label>
            <input type="text" name="firstName" id="firstName" required>
            <div class="break"></div>
            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" id="lastName" required>
            <div class="break"></div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <div class="break"></div>
            <label for="phone">Phone:</label>
            <input type="tel" name="phone" id="phone" required="required">
            <div class="break"></div>
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" required="required">
            <div class="break"></div>
            <label for="city">City:</label>
            <input type="text" name="city" id="city" required="required">
            <div class="break"></div>
            <label for="zipCode">Zip Code:</label>
            <input type="text" name="zipCode" id="zipCode" required="required">
            <div class="break"></div>
            <label for="state">State:</label>
            <select name="state" id="state" required="required">
                <option value="Alabama">Alabama</option>
                <option value="Alaska">Alaska</option>
                <option value="Arizona">Arizona</option>
                <option value="Arkansas">Arkansas</option>
                <option value="California">California</option>
                <option value="Colorado">Colorado</option>
                <option value="Connecticut">Connecticut</option>
                <option value="Delaware">Delaware</option>
                <option value="Florida">Florida</option>
                <option value="Georgia">Georgia</option>
                <option value="Hawaii">Hawaii</option>
                <option value="Idaho">Idaho</option>
                <option value="Illinois">Illinois</option>
                <option value="Indiana">Indiana</option>
                <option value="Iowa">Iowa</option>
                <option value="Kansas">Kansas</option>
                <option value="Kentucky">Kentucky</option>
                <option value="Louisiana">Louisiana</option>
                <option value="Maine">Maine</option>
                <option value="Maryland">Maryland</option>
                <option value="Massachusetts">Massachusetts</option>
                <option value="Michigan">Michigan</option>
                <option value="Minnesota">Minnesota</option>
                <option value="Mississippi">Mississippi</option>
                <option value="Missouri">Missouri</option>
                <option value="Montana">Montana</option>
                <option value="Nebraska">Nebraska</option>
                <option value="Nevada">Nevada</option>
                <option value="New Hampshire">New Hampshire</option>
                <option value="New Jersey">New Jersey</option>
                <option value="New Mexico">New Mexico</option>
                <option value="North Carolina">North Carolina</option>
                <option value="North Dakota">North Dakota</option>
                <option value="Ohio">Ohio</option>
                <option value="Oklahoma">Oklahoma</option>
                <option value="Oregon">Oregon</option>
                <option value="Pennsylvania">Pennsylvania</option>
                <option value="Rhode Island">Rhode Island</option>
                <option value="South Carolina">South Carolina</option>
                <option value="South Dakota">South Dakota</option>
                <option value="Tennessee">Tennessee</option>
                <option value="Texas">Texas</option>
                <option value="Utah">Utah</option>
                <option value="Vermont">Vermont</option>
                <option value="Virginia">Virginia</option>
                <option value="Washington">Washington</option>
                <option value="West Virginia">West Virginia</option>
                <option value="Wisconsin">Wisconsin</option>
                <option value="Wyoming">Wyoming</option>
            </select>
            <div class="break"></div>
            <input type="checkbox" name="usCitizen" id="usCitizen" value="citizen" required="required">
            <label for="usCitizen">US Citizen?</label>
            <div class="break"></div>
            Gender:<input type="radio" name="gender" value="Male" id="male">
            <label for="male">Male</label>
            <input type="radio" name="gender" value="female" id="Female">
            <label for="female">Female</label>
            <div class="break"></div>
            Year In School:<input type="radio" name="schoolYear" value="Freshman" id="freshman">
            <label for="freshman">Freshman</label>
            <input type="radio" name="schoolYear" value="Sophomore" id="sophomore">
            <label for="sophomore">Sophomore</label>
            <input type="radio" name="schoolYear" value="Junior" id="junior">
            <label for="junior">Junior</label>
            <input type="radio" name="schoolYear" value="Senior" id="senior">
            <label for="senior">Senior</label>
            <div class="break"></div>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>