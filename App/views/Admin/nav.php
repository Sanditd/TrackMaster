 <?php 
class Nav {
  public function render() {
    ?>
    <div id="nav">
      <header>
        <div id="logo">
          <img src="<?php echo ROOT?>/Public\img\icon\logo.png" alt="trackmaster logo">
        </div>

        <div id="nav-links">
          <span id="navicon"><img src="<?php echo ROOT?>/Public\img\icon\use.png" alt="how to use"></span>
          <span id="navicon"><img src="<?php echo ROOT?>/Public\img\icon\acc.png" alt="account icon"></span>
        </div>
      </header>
    </div>
    <?php
  }
}
?>