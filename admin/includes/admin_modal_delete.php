<style>
    /* Estilos para el popup */
    .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border: 1px solid #ccc;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        z-index: 9999;
    }

    .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9998;
    }
</style>

<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="popup" style="display: none;">
    <h2>Confirmar eliminación</h2>
    <p>¿Estás seguro de que deseas eliminar la categoría <?php echo $_REQUEST['del_cat_title']; ?> ?</p>
    <form method="post">
        <button type="submit">Eliminar</button>
        <button type="button" onclick="hidePopup()">Cancelar</button>
    </form>
</div>

<script>
    function showPopup() {
        document.getElementById('popupOverlay').style.display = 'block';
        document.getElementById('popup').style.display = 'block';
    }

    function hidePopup() {
        document.getElementById('popupOverlay').style.display = 'none';
        document.getElementById('popup').style.display = 'none';
    }
</script>