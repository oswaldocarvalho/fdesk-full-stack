import {Component} from "react";

export default class BaseComponent extends Component<any, any> {

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
}