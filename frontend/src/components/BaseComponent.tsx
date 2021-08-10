import {Component} from "react";

export default class BaseComponent extends Component<any, any> {

    private errorData:any = {}

    constructor(props:any) {
        super(props)
        this.handleInputChange = this.handleInputChange.bind(this);
        this.formSubmit = this.formSubmit.bind(this);
    }

    formSubmit(event:any) {
        event.preventDefault();
    }

    handleInputChange(event:any) {
        this.setState({[event.target.name]: event.target.value});
    }

    /**
     * Exibição de erros de formulãrio
     */
    clearFormErrors() {
        this.errorData = {}
    }

    setFormErrors(errorData:any) {
        this.errorData = errorData
    }

    getFormError(field:string) {
        if (this.errorData.hasOwnProperty('errors')) {
            return this.errorData.errors[field] ? (<span className="text-danger">{this.errorData.errors[field]}</span>) : ''
        } else if (field==='message') {
            return (<span className="text-danger">{this.errorData.message}</span>)
        }

        return null
    }

    /**
     * Dispara um evento customizado global
     *
     * @param name
     * @param data
     */
    dispatchEvent(name:string, data:any=null):void {
        window.dispatchEvent(new CustomEvent(name, {detail: data}))
    }

    /**
     * Espera por um evento global
     *
     * @param name
     * @param callback
     */
    addEventListener(name:string, callback: (data: any) => void) {
        window.addEventListener(name, (event:any) => {
            event.stopImmediatePropagation()
            callback(event.detail)
        })
    }
}