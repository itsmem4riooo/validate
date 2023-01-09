<?php

require 'vendor/autoload.php';
use Sources\Classes\Validations\Validate;

$Params = [
    'first_name'    => [ 'title'=>'First Name', ['required','max_length'=>25,'checkHtmlTags'] ],
    'last_name'     => [ 'title'=>'Last Name', ['max_length'=>25,'checkHtmlTags'] ],
    'email'         => [ 'title'=>'Email', ['required','checkEmail']],
    'phone'         => [ 'title'=>'Phone', ['required','regex'=>'/^(\([0-9]{2}\) [0-9]{4,5}-[0-9]{4}){0,}$/']],
    'password'      => [ 'title'=>'Password', ['required','confirmPassword'=>'confirm_password','min_length'=>10]],
    'confirm_password' => [ 'title'=>'Confirm Password', ['required','min_length'=>10]]
];

$userForm = new Validate;
$post = filter_input_array(INPUT_POST,FILTER_DEFAULT);

if($userForm->ValidateValues($post,$Params)){
  $Success = 'User registered successfully!';
}

if(!empty($userForm->getError())){
  $Error = $userForm->getError();
}

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Validation form exemple</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    <body>
    <div class="container">
    <div class="d-flex align-items-center flex-column justify-content-center" style="height: 100vh;">

    <form method="post" action="" class="w-50">    
        <?php if(!empty($Error)){ ?>
            <div class="alert alert-danger"><?php echo $Error?></div>
       <?php } ?>
       <?php if(!empty($Success)){ ?>
            <div class="alert alert-success"><?php echo $Success?></div>
       <?php } ?>
  <!-- 2 column grid layout with text inputs for the first and last names -->
  <div class="row mb-4">
    <div class="col">
      <div class="form-outline">
        <input type="text" name="first_name" value="<?php echo @$post['first_name']?>" class="form-control" placeholder="First Name"/>

      </div>
    </div>
    <div class="col">
      <div class="form-outline">
        <input type="text" name="last_name" value="<?php echo @$post['last_name']?>" class="form-control"  placeholder="Last Name"/>
      </div>
    </div>
  </div>

  <!-- Text input -->
  <div class="row">
  <div class="form-outline mb-4 col">
    <input type="text"name="email" class="form-control" value="<?php echo @$post['email']?>" placeholder="E-mail"/>
  </div>

  <!-- Number input -->
  <div class="form-outline mb-4 col">
    <input type="text" name="phone" class="form-control" value="<?php echo @$post['phone']?>" placeholder="Phone, ex: (99) 99999-9999" />
  </div>
  </div>

    <!-- Text input -->
    <div class="row">
  <div class="form-outline mb-4 col">
    <input type="password"name="password" class="form-control" placeholder="password"/>
  </div>

  <!-- Number input -->
  <div class="form-outline mb-4 col">
    <input type="password" name="confirm_password" class="form-control" placeholder="confirm password" />
  </div>
  </div>

  <!-- Submit button -->
  <div class="text-end">
  <button type="submit" class="btn btn-primary btn-block mb-4">Submit</button>
  </div>
</form>
</div></div>

    </body>
</html>  