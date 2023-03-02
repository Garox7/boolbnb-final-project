<div class="delete-popup-backdrop hidden">
    <div class="popup-container">
        <h2>Sei sicuro di voler eliminare l'elemento?</h2>
        <p>L'azione è irreversibile</p>
        <div class="button-container">
            <button class="cancel-button">Annulla</button>
            <form method="POST">
                @method('DELETE')
                @csrf
                <button class="confirm-button">Conferma</button>
            </form>
        </div>
    </div>
</div>
