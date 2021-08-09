
export default class HttpService
{
    static URL:string = "http://localhost:8000/api"

    public static postData (path:string, data:any, callback: (success: boolean, result: any) => void):void {
        this.request('POST', path, data, callback)
    }

    public static getData (path:string, callback: (success: boolean, result: any) => void):void {
        this.request('GET', path, null, callback)
    }

    private static request (method:string, path:string, data:any, callback: (success: boolean, result: any) => void):void {

        method = method.toUpperCase()

        let requestOptions: RequestInit = {
            method: method,
            credentials: 'include',
            headers: {
                Accept : 'application/json',
                'Content-Type': 'application/json'
            }
        }

        if (data) {
            if (method==='POST') {
                requestOptions.body = JSON.stringify(data)
            }
        }

        fetch(`${this.URL}/${path}`, requestOptions).then(
            async response => {
                let result:any = await response.json()
                result.ok = response.ok

                return result
            }
        ).then(response => {
            callback(response.ok, response)
        }).catch(err => {
            callback(false, err)
        })
    }
}