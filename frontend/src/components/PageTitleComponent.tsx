import BaseComponent from "./BaseComponent";

export default class PageTitleComponent extends BaseComponent {
    constructor(props:any) {
        super(props)

        this.state = {
            title: this.props.title
        }
    }

    render() {
        return (
            <div>
                <h1>{this.state.title}</h1>
                <hr/>
            </div>
        )
    }
}