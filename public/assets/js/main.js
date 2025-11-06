const formDelete = document.getElementById('form-delete');

const elements = document.querySelectorAll('.btn-delete');
elements.forEach(el => el.addEventListener('click', event => {
    if(confirm('¿Seguro que quieres borrar la noticia: ' + event.target.dataset.title + '?')) {
        formDelete.action = event.target.dataset.href;
        formDelete.submit();
    }
}));

const deleteModal = document.getElementById('deleteModal');
const spanModalNewsTitle = document.getElementById('modal-news-title');
deleteModal.addEventListener('show.bs.modal', event =>{
    const itemClick = event.relatedTarget;
    const title = itemClick.dataset.title;
    const href = itemClick.dataset.href;
    formDelete.action = href;
    spanModalNewsTitle.textContent = title;
});

/*if(confirm('¿Seguro que quieres borrar la noticia: "título de la noticia"?')) {
    console.log('has confirmado');
    formDelete.action = 'https://dwestarde.hopto.org/laraveles/blogApp/public/blog/1';
    formDelete.submit();
} else {
    console.log('no has confirmado');
}*/