<style>
    /* Estilos para el popup */
    .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px 30px 30px;
        border: 1px solid #ccc;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        z-index: 9999;
    }

    .popup p {
        margin-top: 2rem;
        font-size: 1.8rem;
    }

    .popup form {
        display: flex;
        justify-content: end;
        margin-top: 3rem;
    }

    .popup form button {
        color: white;
        font-size: 1.6rem;
        text-transform: uppercase;
        padding: .8rem;
        background-color: #337ab7;
        border-color: #2e6da4;
        border-radius: 0.5rem;
    }

    .popup form button:first-child {
        margin-right: 1rem;
        background-color: #dc3545;
        border-color: #dc3545;
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
    <h2>Confirm deletion</h2>
    <p>Are you sure you want to delete this post?</p>
    <p class="popup_title"></p>
    <form method="post">
        <button type="submit">Delete</button>
        <button type="button" onclick="hidePopup()">Cancel</button>
    </form>
</div>

<script>
    function showPopup(post_title) {
        var popupBElement = document.querySelector('.popup .popup_title');
        popupBElement.textContent = post_title;
        document.getElementById('popupOverlay').style.display = 'block';
        document.getElementById('popup').style.display = 'block';
    }

    function hidePopup() {
        document.getElementById('popupOverlay').style.display = 'none';
        document.getElementById('popup').style.display = 'none';
    }
</script>