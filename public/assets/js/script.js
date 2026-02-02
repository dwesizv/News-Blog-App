import ApiClient from './modules/ApiClient.js'
import RenderResult from './modules/RenderResult.js'

//obtener elementos de la interfaz con los que se va a interactuar
const baseHref = document.baseURI
const whileFetch = document.getElementById('while-fetch')
let idEditando
const editButton = document.getElementById('editButton')
const editForm = document.getElementById('editForm');

editButton.addEventListener('click', async () => {
    whileFetch.classList.remove('hide')
    const formData = new FormData(editForm)
    const apiClient = new ApiClient(baseHref)
    const result = await apiClient.fetchEdit(idEditando, formData)
    whileFetch.classList.add('hide')
    console.log(result)
})

const initialFetch = async () => {
    whileFetch.classList.remove('hide')
    const apiClient = new ApiClient(baseHref)
    const result = await apiClient.fetchAll()
    whileFetch.classList.add('hide')
    return result
}

const initialRender = (data) => {
    const mainParent = document.getElementById('fetchAllResult')
    const renderResult = new RenderResult(mainParent)
    renderResult.renderFetchAllResult(data)
}

const data = await initialFetch()
initialRender(data)

const modal = document.getElementById('editModal')
modal.addEventListener('show.bs.modal', async (event) => {
    const target = event.relatedTarget
    const id = target.dataset.id
    idEditando = id
    
    const title = document.getElementById('title')
    const entry = document.getElementById('entry')
    const text = document.getElementById('text')
    const author = document.getElementById('author')
    const idgenre = document.getElementById('idgenre')
    title.value = ''
    entry.value = ''
    text.value = ''
    author.value = ''
    idgenre.value = ''

    whileFetch.classList.remove('hide')
    const apiClient = new ApiClient(baseHref)
    const result = await apiClient.fetchOne(id)
    whileFetch.classList.add('hide')
    
    title.value = result.data.titulo
    entry.value = result.data.entrada
    text.value = result.data.texto
    author.value = result.data.autor
    idgenre.value = result.data.genero.id
    console.log(result)
})
modal.addEventListener('shown.bs.modal', event => {
    console.log('shown')
})