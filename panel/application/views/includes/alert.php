<?php

$alert = $this->session->userdata("alert");

    if (isset($alert)){
        if ($alert["type"] === "success"){ ?>

            <script>
                iziToast.success({
                    title: "<?= $alert['title'] ?>",
                    message: "<?= $alert['message'] ?>",
                    position: 'topCenter'
                });
            </script>

        <?php }else{ ?>
            <script>
                iziToast.error({
                    title: "<?= $alert['title'] ?>",
                    message: "<?= $alert['message'] ?>",
                    position: 'topCenter'
                });
            </script>
        <?php }
    }

?>