    <!-- footer area start -->
    <?php 

        if (!isset($footer)) {
            include './partials/footer.php';
        }
    ?>
    <!-- footer area end -->

    <div id="anywhere-home" class=""></div>

    <!-- side bar area  -->
    <?php include './partials/sideBar.php'?>
    <!-- side abr area end -->

    <!-- pre loader start -->
    <?php include './partials/preLoader.php'?>
    <!-- pre loader end -->

    <!-- THEME MODE SWITCHER -->
    <?php include './partials/themeMode.php'?>
    <!-- THEME MODE SWITCHER END -->

    <!-- progress area start -->
    <?php include './partials/progress.php'?>
    <!-- progress area end -->

    <?php include './partials/script.php'?>
    
</body>

</html>