<?php
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}
include "dashboard_left_pane.php";

if (file_exists('config/general_user_authentication.php')) {
    include('config/general_user_authentication.php');
}

if (file_exists('config/event_page_authentication.php')) {
    include('config/event_page_authentication.php');
}

?>
<!--CENTER SECTION-->

<div class="ud-main">
    <div class="ud-main-inn ud-no-rhs">
        <div class="ud-cen">
            <div class="log-bor">&nbsp;</div>
            <span class="udb-inst">Booked Pass</span>
            <?php include('config/user_activation_checker.php'); ?>
            <div class="ud-cen-s2">
                <h2><?php echo $BIZBOOK['EVENT_DETAILS']; ?></h2>
                <table class="responsive-table bordered">
                    <thead>
                        <tr>
                            <th><?php echo $BIZBOOK['S_NO']; ?></th>
                            <th>Person Name</th>
                            <th>Booking Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $si = 1;
                        foreach (getBookedPassByEventID($_GET["code"]) as $eventrow) {
                        ?>
                            <tr>
                                <td><?php echo $si; ?></td>
                                <td><?php echo $eventrow['first_name']; ?> </td>
                                <td><?php echo dateFormatconverter($eventrow['created_at']); ?></td>
                            </tr>
                        <?php
                            $si++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        include "dashboard_right_pane.php";
        ?>