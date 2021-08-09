import React from 'react';
import {BrowserRouter, Switch, Route} from 'react-router-dom';
// import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';

import HomePage from "./pages/HomePage";
import LoginPage from "./pages/LoginPage";
import RegisterPage from "./pages/RegisterPage";
import DashboardPage from "./pages/DashboardPage";

function App() {
  return (
    <BrowserRouter>
        <Switch>
            <Route path="/" exact={true} component={HomePage}/>
            <Route path="/login" exact={true} component={LoginPage}/>
            <Route path="/register" exact={true} component={RegisterPage}/>

            <Route path="/dashboard" exact={true} component={DashboardPage}/>
        </Switch>
    </BrowserRouter>
  );
}

export default App;
