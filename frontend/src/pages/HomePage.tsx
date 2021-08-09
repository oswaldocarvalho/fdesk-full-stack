import {Component} from "react";
import {Container} from "react-bootstrap";

export default class HomePage extends Component {
    render() {
        return (
            <Container>
                Homepage
                <br />
                <a href="/login">Login</a>
                <br />
                <a href="/register">Nova conta</a>
            </Container>
        );
    }
}