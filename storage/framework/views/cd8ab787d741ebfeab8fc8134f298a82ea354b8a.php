<?php if(!empty($msg)): ?>
<?php $__env->startSection('message'); ?>
    <div id = "message" class="<?php if(!empty($msg['msg_type'])): ?><?php echo e($msg['msg_type']); ?><?php endif; ?>">
        <?php if(!empty($msg['msg_type'])): ?> 
        <?php if($msg['msg_type']=='success'): ?>
          <img src="/images/success.png" />
        <?php else: ?>
          <img src="/images/error.jpeg" />
        <?php endif; ?>
        <?php endif; ?>
        <div id="msg_txt"><?php echo e($msg['msg_txt']); ?></div>
    </div>
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php if(Session::has('username') && Session::has('userid') && Session::has('userstatus')): ?>
  <?php $__env->startSection('title','Profile'); ?>
  <?php $__env->startSection('content'); ?>
     <div class="p_box">
        email: <?php echo e(Session::get('username')); ?><br /><br />
        user id: <?php echo e(Session::get('userid')); ?><br /><br />
        status: 
        <?php if(Session::get('userstatus') == '1'): ?> 
        Active
        <?php else: ?>
        Not active
        <?php endif; ?>
        <br /><br /><br />
        <a href="/logout">logout</a>
    </div>
 <?php $__env->stopSection(); ?>
<?php else: ?>
  <?php $__env->startSection('title','Login / Sign up'); ?>
  <?php $__env->startSection('content'); ?>
     <div id="wrap">
          <h3>Login / Signup Form</h3>
          <p>Please enter your name and email addres to create your account</p>
          <div id="msg">
          </div>
          <!-- start sign up form -->
          <form id="login" action="/login" method="post">
              <?php echo e(csrf_field()); ?>

              <label for="email">Email:</label>
              <input type="email" name="email" id="email" placeholder="example@domain.com"  value="<?php if(!empty($msg['email'])): ?><?php echo e($msg['email']); ?><?php endif; ?>" />
              <label for="password">Password:</label>
              <input type="password" name="password" id="password" value="" />
<input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>" />
              <input type="submit" class="submit_button" value="Login" />

          </form>
          <!-- end sign up form -->
      </div>
  <?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>