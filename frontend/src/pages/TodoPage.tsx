import {Alert, Button, Container, Form, InputGroup, Nav} from "react-bootstrap";
import NavComponent from "../components/NavComponent";
import BaseComponent from "../components/BaseComponent";
import HttpService from "../services/HttpService";
import TodoComponent from "../components/TodoComponent";
import PageTitleComponent from "../components/PageTitleComponent";

export default class TodoPage extends BaseComponent {
    constructor(props:any) {
        super(props)

        this.state = {
            todo: '',

            todos: [],
            success:false,
            filter: 'ALL'
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

        this.addEventListener('onTodoChange', (data:any) => {

            let todos = this.state.todos
            let index = todos.findIndex((item:any) => item.id===data.id)

            if (data.deleted) {
                todos.splice(index, 1)
            } else {
                todos[index].completed_at = data.completed_at
            }

            this.setState({
                todos: todos
            })
        })
    }

    formSubmit(event:any) {
        super.formSubmit(event);

        HttpService.postData('todos', {todo: this.state.todo}, (success:boolean, result:any) => {
            this.clearFormErrors()

            if (!success) {
                console.log(result)
                this.setFormErrors(result)
                this.setState({success:false})
                return
            }

            // adiciona o registro no final da lista para não precisar buscar novamente
            this.state.todos.push(result.data)

            this.setState({
                success: true,
                todo: '',

                todos: this.state.todos
            })
        })
    }

    onFilterSelect = (event:any) => {
        this.setState({filter: event})
    }

    render() {

        console.log('entrou render')

        let todos:Array<any> = []

        switch (this.state.filter) {
            case 'ALL':
                todos = this.state.todos.map( (record:any, i:number) => {
                    return <TodoComponent record={record} key={record.id} />
                })
                break;
            case 'PENDING':
                todos = this.state.todos.filter((value:any) => value.completed_at==null).map( (record:any, i:number) => {
                    return <TodoComponent record={record} key={record.id} />
                })
                break;
            case 'COMPLETED':
                todos = this.state.todos.filter((value:any) => value.completed_at!=null).map( (record:any, i:number) => {
                    return <TodoComponent record={record} key={record.id} />
                })
                break;
        }

        return (
            <>
                <NavComponent />
                <Container>
                    <PageTitleComponent title="Lista de tarefas" />

                    <Nav variant="pills" defaultActiveKey="ALL" onSelect={this.onFilterSelect}>
                        <Nav.Item>
                            <Nav.Link eventKey="ALL">Todos</Nav.Link>
                        </Nav.Item>
                        <Nav.Item>
                            <Nav.Link eventKey="PENDING">Pendentes</Nav.Link>
                        </Nav.Item>
                        <Nav.Item>
                            <Nav.Link eventKey="COMPLETED">Concluídos</Nav.Link>
                        </Nav.Item>
                    </Nav>

                    <hr />

                    {todos.length>0? todos : (<Alert variant="info">Nenhuma tarefa encontrada</Alert>)}

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
                            {this.getFormError('todo')}
                        </Form>
                    </Alert>
                </Container>
            </>
        );
    }
}
