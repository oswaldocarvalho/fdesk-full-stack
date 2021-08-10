import {Button, ButtonGroup, Col, Form, Modal, Row} from "react-bootstrap";
import HttpService from "../services/HttpService";
import BaseComponent from "./BaseComponent";
import {CheckLg, PencilFill, Trash, XLg} from "react-bootstrap-icons";

export default class TodoComponent extends BaseComponent {
    constructor(props:any) {
        super(props)

        this.state = {
            id: props.record.id,
            todo: props.record.todo,
            completed_at: props.record.completed_at,

            deleted:false,
            showModal:false,
            newTodo: ''
        }

        console.log('construct novamente ?')
    }

    toggleCompleted = () => {
        HttpService.patchData(`todos/${this.state.id}/toggle-completed` , null, (success:boolean, result:any) => {
            if (success) {
                console.log('entrou')
                this.setState({completed_at: result.data.completed_at})
            }
        })
    }

    deleteTodo = () => {
        if (!window.confirm('Deseja realmente apagar a tarefa?')) {
            return
        }

        HttpService.deleteData(`todos/${this.state.id}`, (success:boolean, result:any) => {
            if (success) {
                this.setState({deleted: true})
            }
        })
    }

    showModal = () => {
        this.setState({
            newTodo: this.state.todo,
            showModal: true
        })
    }

    formSubmit(event:any) {
        super.formSubmit(event);

        HttpService.patchData(`todos/${this.state.id}`, {todo: this.state.newTodo}, (success:boolean) => {
            if (success) {
                this.setState({
                    showModal: false,
                    todo: this.state.newTodo
                })
            }

        })
    }

    render() {

        if (this.state.deleted) {
            return '';
        }

        return (
            <>
                <Row>
                    <Col md={8} className="my-1">
                        <Button variant="outline-primary" className="me-2" key="bt1" onClick={this.toggleCompleted}>
                            {this.state.completed_at==null ? (<CheckLg size={18} />) : (<XLg size={18} />)}
                        </Button>

                        {this.state.completed_at==null ? (this.state.todo) : (<s>{this.state.todo}</s>)}
                    </Col>
                    <Col md={4} className="my-1 text-end">
                        <ButtonGroup>
                            <Button variant="primary" key="bt1" onClick={this.showModal}><PencilFill size={18} /></Button>
                            <Button variant="warning" key="bt2" onClick={this.deleteTodo}><Trash size={18} /></Button>
                        </ButtonGroup>
                    </Col>
                </Row>

                <Modal show={this.state.showModal}>
                    <Form onChange={this.handleInputChange} onSubmit={this.formSubmit} method="post">
                        <Modal.Header closeButton onClick={() => {this.setState({showModal: false})}}>
                            <Modal.Title>Alterar tarefa</Modal.Title>
                        </Modal.Header>
                        <Modal.Body>
                            <Form.Group className="mb-3" controlId="formBasicEmail">
                                <Form.Label>Tarefa</Form.Label>
                                <Form.Control type="text" name="newTodo" value={this.state.newTodo} />
                            </Form.Group>
                        </Modal.Body>
                        <Modal.Footer>
                            <Button variant="secondary" onClick={() => {this.setState({showModal: false})}}>
                                Cancelar
                            </Button>
                            <Button variant="success" type="submit">
                                Salvar
                            </Button>
                        </Modal.Footer>
                    </Form>
                </Modal>
            </>
        )
    }
}