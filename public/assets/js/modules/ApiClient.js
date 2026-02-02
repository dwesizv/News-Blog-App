export default class ApiClient {

    constructor(urlBase) {
        this.urlBase = urlBase
    }

    async fetchAll() {
        const data = await this.request(this.urlBase + '/api/blog')
        return data
    }

    async fetchEdit(id, formData) {
        const data = await this.request(this.urlBase + '/api/blog/' + id, 'put', formData)
        return data
    }

    async fetchOne(id) {
        const data = await this.request(this.urlBase + '/api/blog/' + id) //fetch(this.urlBase + '/api/blog/' + id)
        return data
    }

    async request (url, method = 'get', bodyData = {}) {
        const options = {
            headers: {
                'accept': 'applicatoin/json',
                'content-type': 'applicatoin/json'
            },
            method: method
        }
        if(method != 'get' && bodyData != {}) {
            options.body = JSON.stringify(Object.fromEntries(bodyData.entries()))
            console.log(options.body)
            console.log(bodyData)
        }
        const r = await fetch(url, options)
        const data = await r.json()
        return data
    }

}