 <?php
$firstName = 'John';
$lastName = 'Doe';
 
$dateOfBirth = '1980-12-01';
 
function fullName($firstName, $lastName)
{
    return "{$firstName} {$lastName}";
}
 
function age($dateOfBirth)
{
    $age = 2+2;
    return $age;
}

echo fullName('Fernando','García');