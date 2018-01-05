<h1>Login</h1>
<?php echo validation_errors(); ?>
<?php echo form_open('user') ?>
  User Name : <input type="input" name="name"/><br />
  Email : <input type="input" name="email"/><br />
  Department : <input type="radio" value="LessoHome" name="department" />LessoHome</t>
  <input type="radio" value="Procurement" name="department" />Procurement</t>
  <input type="radio" value="Trade Guarantee" name="department" />Trade Guarantee</br>
  <input type="submit" name="submit" value="Log in"/>
<?php echo form_close(); ?>
