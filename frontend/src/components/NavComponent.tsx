import {Button, Container, Nav, Navbar} from "react-bootstrap";
import HttpService from "../services/HttpService";
import {Redirect} from "react-router-dom";
import BaseComponent from "./BaseComponent";

export default class NavComponent extends BaseComponent {
    constructor(props:any) {
        super(props)

        this.state = {
            success:false
        }
    }

    logout = () => {
        HttpService.getData('users/logout', (success:boolean, result:any) => {
            this.setState({success: success})
        })
    }

    render() {

        if (this.state.success) {
            return <Redirect to="/login" />
        }

        return (
            <Navbar collapseOnSelect expand="lg" bg="primary" variant="dark">
                <Container>
                    <Navbar.Brand href="#home">TODO</Navbar.Brand>
                    <Navbar.Toggle aria-controls="responsive-navbar-nav" />
                    <Navbar.Collapse id="responsive-navbar-nav">
                        <Nav className="me-auto">
                            <Nav.Link href="#features">Tarefas</Nav.Link>
                        </Nav>
                        <Nav>
                            <Nav.Link href="#deets">
                                <Button variant="warning" onClick={this.logout}>Sair</Button>
                            </Nav.Link>
                        </Nav>
                    </Navbar.Collapse>
                </Container>
            </Navbar>
        )
    }
}