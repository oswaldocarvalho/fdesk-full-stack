import {Component} from "react";
import {Container} from "react-bootstrap";
import NavComponent from "../components/NavComponent";
import PageTitleComponent from "../components/PageTitleComponent";

export default class DashboardPage extends Component {

    render() {
        return (
            <>
                <NavComponent />
                <Container>
                    <PageTitleComponent title="Dashboard" />
                </Container>
            </>
        );
    }
}