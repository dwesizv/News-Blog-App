export default class RenderResult {

    constructor(parent) {
        this.parent = parent
    }

    renderFetchAllResult(json) {
        json.data.data.forEach((blog) => {
            const row = this.renderRowResult(blog)
            this.parent.appendChild(row)
        })
    }

    renderRowResult(row) {
        const tr = document.createElement('tr')
        tr.appendChild(this.renderTdElement(row.id))
        tr.appendChild(this.renderTdElement(row.title))
        tr.appendChild(this.renderTdElement(row.author))
        tr.appendChild(this.renderTdElement(row.user.name))
        tr.appendChild(this.renderTdEditElement(row.id))
        return tr
    }

    renderTdElement(text) {
        const td = document.createElement('td')
        const textNode = document.createTextNode(text)
        td.appendChild(textNode)
        return td 
    }

    renderTdEditElement(id) {
        const td = document.createElement('td')
        const ahref = document.createElement('a')
        ahref.classList.add('btn','btn-warning', 'btnEdit')
        ahref.setAttribute('data-id', id)
        ahref.setAttribute('data-bs-toggle', 'modal')
        ahref.dataset.bsTarget = '#editModal'
        /*ahref.addEventListener('click', () => {
            console.log('1')
        })*/
        const textNode = document.createTextNode('edit')
        ahref.appendChild(textNode)
        td.appendChild(ahref)
        return td 
    }
}