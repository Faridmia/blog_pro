<?php include 'inc/header.php' ?>
<style>
    .success{
        font-size: 24px;
        color:green;
    }
    .error{
        font-size: 24px;
        color:red;
    }
</style>
<?php include 'inc/sidebar.php' ?>
<?php
                if(!isset($_GET['msgid']) || $_GET['msgid'] == null){
                    echo "<script>window.location = 'inbox.php';</script>";
                    
                }
                else
                {
                    $viewid = $_GET['msgid'];
                }
                
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Page</h2>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $To        = $fm->validation($_POST['Toemail']);
                $form      = $fm->validation($_POST['formemail']);
                $subject   = $fm->validation($_POST['subject']);
                $message   = $_POST['message'];
                $message       = mysqli_real_escape_string($db->link,$message);

                $sendmail = mail($To, $subject, $message,$form);
                if($sendmail){
                    echo "<span class='success'>Message send Successfully.
                             </span>";
                }
                else{
                    echo "<span class='error'>Something went wrong!.
                             </span>";
                }
              
               
                    
            }
        
    ?>
                <div class="block">               
                 <form action="" method="post">
                    <?php
                            $query = "SELECT * FROM tbl_contact WHERE con_id='$viewid'";
                            $viewmsg = $db->select($query);
                            if($viewmsg){
                                $i = 0;
                                while ($result = $viewmsg->fetch_assoc()) {
                                    $i++;
                    
                ?>
                    <table class="form">
                       
                         <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" readonly name="Toemail" value="<?php echo $result['email'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text"  name="formemail" placeholder="please enter your email" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text"  name="subject" class="medium" />
                            </td>
                        </tr>
                         
                        <tr>
                            <td>
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="message">
                                    
                                </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="send" />
                            </td>
                        </tr>
                    </table>
                    <?php } }?>
                    </form>
                </div>
            </div>
        </div>

<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
            });
</script>
<?php include 'inc/footer.php' ?>
 <!-- Load TinyMCE -->
