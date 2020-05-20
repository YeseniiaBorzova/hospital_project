<style>
    Body {
        font-family: Calibri, Helvetica, sans-serif;
        background-color: lightskyblue;
    }
    button {
        background-color: darkblue;
        width: 20%;
        color: white;
        padding: 15px;
        margin: 10px 0px;
        border: none;
        cursor: pointer;
        transition-duration: 0.4s;
        opacity: 0.7;
    }
    button:hover{
        background-color: #3167ff;
        color: white;
        box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
    }
    form {
        border: 3px solid #f1f1f1;
    }
    input[type=text], input[type=password] {
        width: 20%;
        margin: 8px 0;
        padding: 12px 20px;
        display: inline-block;
        border: 3px solid darkblue;
        box-sizing: border-box;
        box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
    }
</style>
<form method="post" action="index.php">
    <p>
        <label for="username">This time is engaged</label>
    </p>
    <p>
        <button type="submit" name="error_ok">OK</button>
    </p>

</form>