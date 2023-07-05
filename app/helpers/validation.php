<?php
class Validation {
    public static function ValidateUsername(string $username, User $user) : string {
        $usernameErr = '';
        if (self::IsBlank($username))
            $usernameErr = 'Please enter username';
        else if (!self::ValidUsernameLength($username, 6, 32))
            $usernameErr = 'Usernames must be between 6 and 32 characters';
        else if ($user->FindUsername($username))
            $usernameErr = 'Username already been used';
        return $usernameErr;
    }
    public static function ValidatePassword(string $password, string $username) : string {
        $passwordErr = '';
        if (self::IsBlank($password))
            $passwordErr = 'Please enter password';
        else if (!self::ValidPasswordLength($password, 8))
            $passwordErr = 'Password must be at least 8 characters';
        else if (!self::HasUppercase($password))
            $passwordErr = 'Password must contain at least one uppercase letter';
        else if (!self::HasNumber($password))
            $passwordErr = 'Password must contain at least one number';
        else if (str_contains($password, $username))
            $passwordErr = 'Password cannot contain username';
        return $passwordErr;
    }
    public static function ValidatePasswordMatch(string $password, string $confirmPassword) : string {
        $confirmPasswordErr = "";
        if (Validation::IsBlank($confirmPassword))
            $confirmPasswordErr = 'Please enter password';
        else if ($confirmPassword !== $password)
            $confirmPasswordErr = 'Does not match entered password';
        return $confirmPasswordErr;
    }
    public static function IsBlank($input) : bool {
        return !isset($input) || trim($input) === '';
    }
    public static function ValidUsernameLength($input, $min = '6', $max = '32') : bool {
        return (strlen($input) >= $min && strlen($input) <= $max);
    }
    public static function ValidPasswordLength($input, $minLength = '8') : bool {
        return (strlen($input) >= $minLength);
    }
    public static function HasUppercase($input) : false|int {
        return preg_match('/[A-Z]/', $input);
    }
    public static function HasNumber($input) : false|int {
        return preg_match('/[0-9]/', $input);
    }
}