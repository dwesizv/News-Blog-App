const deleteModal = document.getElementById('deleteModal');
const elements = document.querySelectorAll('.btn-delete');
const formDelete = document.getElementById('form-delete');
const spanModalNewsTitle = document.getElementById('modal-news-title');

elements.forEach(el => el.addEventListener('click', event => {
    if(confirm('¿Seguro que quieres borrar la noticia: ' + event.target.dataset.title + '?')) {
        formDelete.action = event.target.dataset.href;
        formDelete.submit();
    }
}));

deleteModal.addEventListener('show.bs.modal', event => {
    formDelete.action = event.relatedTarget.dataset.href;
    spanModalNewsTitle.textContent = event.relatedTarget.dataset.title;
});