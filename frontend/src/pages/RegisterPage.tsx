import {Button, Col, Container, Form, Nav, Row} from "react-bootstrap";
import HttpService from "../services/HttpService";
import BaseComponent from "../components/BaseComponent";
import {Redirect} from "react-router-dom";
import PageTitleComponent from "../components/PageTitleComponent";

export default class RegisterPage extends BaseComponent {

    constructor(props:any) {
        super(props)

        this.state = {
            name: null,
            email: null,
            password: null,
            password_confirmation: null,

            success:false,
            errors: []
        }
    }

    formSubmit(event:any) {
        super.formSubmit(event);

        HttpService.postData('users/register', {
            name: this.state.name,
            email: this.state.email,
            password:this.state.password,
            password_confirmation:this.state.password_confirmation},
            (success:boolean, result:any) => {
                if (!success) {
                    this.setFormErrors(result)
                }

                this.setState({success: success})
            }
        )
    }

    render() {
        if (this.state.success) {
            return <Redirect to="/login" />
        }

        return (
            <Container>
                <PageTitleComponent title="Nova conta" />

                {this.getFormError('message')}

                <Form onChange={this.handleInputChange} onSubmit={this.formSubmit} method="post">
                    <Form.Group className="mb-3" controlId="formBasicEmail">
                        <Form.Label>Nome completo</Form.Label>
                        <Form.Control type="text" placeholder="Nome completo" name="name" />
                        {this.getFormError('name')}
                    </Form.Group>

                    <Form.Group className="mb-3" controlId="formBasicEmail">
                        <Form.Label>Email address</Form.Label>
                        <Form.Control type="email" placeholder="Enter email" name="email" />
                        {this.getFormError('email')}
                    </Form.Group>

                    <Row>
                        <Col>
                            <Form.Group className="mb-3" controlId="formBasicPassword">
                                <Form.Label>Password</Form.Label>
                                <Form.Control type="password" placeholder="Password" name="password" />
                                {this.getFormError('password')}
                            </Form.Group>
                        </Col>
                        <Col>
                            <Form.Group className="mb-3" controlId="formBasicPassword">
                                <Form.Label>Redigite o password</Form.Label>
                                <Form.Control type="password" placeholder="Confirme o password" name="password_confirmation" />
                            </Form.Group>
                        </Col>
                    </Row>

                    <Button variant="primary" type="submit">
                        Salvar
                    </Button>
                </Form>

                <Nav.Link href="/login">Já tenho conta, login!</Nav.Link>
            </Container>
        );
    }
}