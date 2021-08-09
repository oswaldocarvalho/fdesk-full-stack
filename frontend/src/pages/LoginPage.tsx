import {Button, Container, Form, Nav} from "react-bootstrap";
import BaseComponent from "../components/BaseComponent";
import HttpService from "../services/HttpService";
import {Redirect} from "react-router-dom";

export default class LoginPage extends BaseComponent {

    constructor(props:any) {
        super(props)

        this.state = {
            email: null,
            password: null,
            success:false
        }
    }

    formSubmit(event:any) {
        super.formSubmit(event);

        HttpService.postData('users/login', this.state, (success:boolean) => {
            this.setState({success: success})
        })
    }

    render() {
        if (this.state.success) {
            return <Redirect to="/dashboard" />
        }

        return (
            <Container>
                <h1>Login</h1>
                <hr />
                <Form onChange={this.handleInputChange} onSubmit={this.formSubmit} method="post">
                    <Form.Group className="mb-3" controlId="formBasicEmail">
                        <Form.Label>Email address</Form.Label>
                        <Form.Control type="email" placeholder="Enter email" name="email" />
                    </Form.Group>

                    <Form.Group className="mb-3" controlId="formBasicPassword">
                        <Form.Label>Password</Form.Label>
                        <Form.Control type="password" placeholder="Password" name="password" />
                    </Form.Group>

                    <Button variant="primary" type="submit">
                        Login
                    </Button>
                </Form>

                <Nav.Link href="/register">Criar uma conta</Nav.Link>
            </Container>
        );
    }
}