import {Alert, Button, ButtonGroup, Col, Container, Form, FormControl, InputGroup, Row} from "react-bootstrap";
import NavComponent from "../components/NavComponent";
import BaseComponent from "../components/BaseComponent";
import HttpService from "../services/HttpService";
import TodoComponent from "../components/TodoComponent";
import {CheckLg, PencilFill, Trash, XLg} from "react-bootstrap-icons";
import PageTitleComponent from "../components/PageTitleComponent";

export default class DashboardPage extends BaseComponent {
    constructor(props:any) {
        super(props)

        this.state = {
            todo: '',
            todos: [],
            success:false
        }
    }


    componentDidMount() {
        HttpService.getData('todos', (success:boolean, result:any) => {
            if (success) {
                this.setState({
                    todos: result.data
                })
            }
        })
    }

    formSubmit(event:any) {
        super.formSubmit(event);

        HttpService.postData('todos', {todo: this.state.todo}, (success:boolean, result:any) => {
            if (success) {

                // adiciona o registro no final da lista para não precisar buscar novamente
                let todos:Array<any> = this.state.todos;
                todos.push(result.data)

                this.setState({
                    success: true,
                    todo: '',
                    todos: todos
                })
            }
        })
    }

    render() {

        let todos:Array<any> = this.state.todos.map( (record:any, i:number) => {
            return <TodoComponent record={record} key={record.id} />
        })

        return (
            <>
                <NavComponent />
                <Container>
                    <PageTitleComponent title="Lista de tarefas" />

                    {todos}

                    <hr />

                    <Alert variant="success">
                        <Form onChange={this.handleInputChange} onSubmit={this.formSubmit} method="post">
                            <Form.Label>Tarefa</Form.Label>
                            <InputGroup>
                                <Form.Control type="text" name="todo" value={this.state.todo} />
                                <Button variant="primary" type="submit">
                                    Adicionar
                                </Button>
                            </InputGroup>
                        </Form>
                    </Alert>
                </Container>
            </>
        );
    }
}
