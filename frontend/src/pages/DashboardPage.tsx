import {Component} from "react";
import {Container} from "react-bootstrap";
import NavComponent from "../components/NavComponent";

export default class DashboardPage extends Component {

    render() {
        return (
            <>
                <NavComponent />
                <Container>
                    Dashboard
                </Container>
            </>
        );
    }
}