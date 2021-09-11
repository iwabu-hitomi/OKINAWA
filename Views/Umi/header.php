

<header>
  <nav id="nav__top">
    <div id="nav">
      <div class="top__right">
        <a href="index.php">
          <img src="../img/logo2.png" class="logo">
        </a>
      </div>


      <div class="top__nav">

          <a href='mypage.php?id=<?=$_SESSION['id']?>' id='my_page' class='my_page'>マイページ</a>

          <a href='insert.php' id='logout' class='logout'>投稿</a>
          <a href='logout.php' id='logout' class='logout'>ログアウト</a>

      </div>

    </div>
  </nav>
</header>

<!-- <script>

  jQuery( window ).on( 'scroll', function() {
     if ( 65 < jQuery( this ).scrollTop() ) {
        jQuery( '#nav__top' ).addClass( 'fixed' );
     } else {
        jQuery( '#nav__top' ).removeClass( 'fixed' );
     }
  });
</script>
<script src="../js/index.js"></script> -->
