const deleteModal = document.getElementById('deleteModal');
const elements = document.querySelectorAll('.btn-delete');
const formDelete = document.getElementById('form-delete');
const idgenre = document.getElementById('idgenre');
const spanModalNewsTitle = document.getElementById('modal-news-title');

if(deleteModal) {
    deleteModal.addEventListener('show.bs.modal', event => {
        formDelete.action = event.relatedTarget.dataset.href;
        spanModalNewsTitle.textContent = event.relatedTarget.dataset.title;
    });
}

if(elements) {
    elements.forEach(el => el.addEventListener('click', event => {
        if(confirm('¿Seguro que quieres borrar la noticia: ' + event.target.dataset.title + '?')) {
            formDelete.action = event.target.dataset.href;
            formDelete.submit();
        }
    }));
}

/*if(idgenre) {
    idgenre.addEventListener('change', e => {
        document.getElementById('filterForm').submit();
    });
}*/