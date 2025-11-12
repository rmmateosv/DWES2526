    <div>
        <?php
        if (isset($error)) {
            echo '<h3 style="color:red;">' . $error . '</h3>';
        }
        ?>
    </div>
    <div>
        <?php
        if (isset($mensaje)) {
            echo '<h3 style="color:green;">' . $mensaje . '</h3>';
        }
        ?>
    </div>    
</body>
</html>