<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<head>
<link rel="stylesheet" type="text/css" media="all" href="<?= base_url('assets/style_login.css')?>" >
<script type="text/javascript" src="<?= base_url('assets/login.js')?>"></script>
<script type="text/javascript" src="<?= base_url('assets/timeonsitetracker.js')?>"></script>
</head>
<div class="login-page">
  <div class="form">
    <form class="register-form">
      <input type="text" placeholder="name"/>
      <input type="password" placeholder="password"/>
      <input type="text" placeholder="email address"/>
      <button>create</button>
      <p class="message">Already registered? <a href="<?= base_url('data/signIn')?>">Sign In</a></p>
    </form>
    <form class="login-form">
      <input type="text" placeholder="username"/>
      <input type="password" placeholder="password"/>
      <button>login</button>
      <p class="message">Not registered? <a href="<?= base_url('main/signUp')?>">Create an account</a></p>
    </form>
  </div>
</div>