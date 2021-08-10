import {Component} from "react";
import {Container} from "react-bootstrap";
import PageTitleComponent from "../components/PageTitleComponent";

export default class HomePage extends Component {
    render() {
        return (
            <Container>
                <PageTitleComponent title="Home" />
                <br />
                <a href="/login">Login</a>
                <br />
                <a href="/register">Nova conta</a>
            </Container>
        );
    }
}