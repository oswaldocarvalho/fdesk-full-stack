import React from 'react';
import {BrowserRouter, Switch, Route} from 'react-router-dom';
// import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';

import HomePage from "./pages/HomePage";
import LoginPage from "./pages/LoginPage";
import RegisterPage from "./pages/RegisterPage";
import DashboardPage from "./pages/DashboardPage";
import TodoPage from "./pages/TodoPage";

function App() {
  return (
    <BrowserRouter>
        <Switch>
            <Route path="/" exact={true} component={HomePage}/>
            <Route path="/login" exact={true} component={LoginPage}/>
            <Route path="/register" exact={true} component={RegisterPage}/>

            <Route path="/dashboard" exact={true} component={DashboardPage}/>
            <Route path="/to-do" exact={true} component={TodoPage}/>
        </Switch>
    </BrowserRouter>
  );
}

export default App;
