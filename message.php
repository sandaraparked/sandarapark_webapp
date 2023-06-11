<?php

//green
if(isset($_SESSION['message']))
{
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    unset($_SESSION['message']); 
}

if(isset($_SESSION['tp_message']))
{
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $_SESSION['tp_message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    unset($_SESSION['message']); 
}

//red
if(isset($_SESSION['r_message']))
{
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $_SESSION['r_message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    unset($_SESSION['r_message']); 
}

//yellow
if(isset($_SESSION['y_message']))
{
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?= $_SESSION['y_message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    unset($_SESSION['y_message']); 
}

?>
