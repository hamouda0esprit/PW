<?php
    function getAdmin(){
        require_once("config2.php");
        $bd = new config();
        $pdo = $bd::getConnexion();

        /*jointure entre table messages et table report **/

        try{
            $query = $pdo->prepare(
                'SELECT r.report_id AS request_id, m.msg_id, m.msg AS message
                FROM report r
                JOIN messages m ON r.msg_id = m.msg_id;
                ;'
            );

            $query->execute();
            $result = $query->fetchAll();

        }catch(PDOExcepion $e){
            echo "connection failed :". $e->getMessage();
        }
        foreach($result as $row){
    

?>
    <tr>
    <td><?php echo "#" . $row["request_id"] ?></td>
    <td><?php echo $row["message"] ?></td>
    <td>
        <form action="php/ban.php" method="POST" onsubmit="return confirmdelete()">
            <input type="text" name="request_id" id="request_id" style="display:none;" value="<?php echo $row["msg_id"]?>">
            <input type="submit" value="ban" class="btn">
        </form>
        <form action="php/removeReq.php" method="POST" onsubmit="return confirmdelete()">
            <input type="text" name="request_id" id="request_id" style="display:none;" value="<?php echo $row["request_id"] ?>">
            <input type="submit" value="remove" class="btn">
            <textarea name="reason" id="reason" cols="30" rows="10"></textarea>
        </form>
    </td>
    
    </tr>
<?php
}
    }


?>