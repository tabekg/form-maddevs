import React from 'react';
import './AppComponent.css';
import {
  Navbar, Nav,
  Container
} from 'react-bootstrap';
import { Link, Route } from 'react-router-dom';
import HomeComponent from './HomeComponent';

class AppComponent extends React.Component {
  render(){
    return (
      <div className="App">
        <Navbar bg="primary" variant="dark">
          <Container>
            <Navbar.Brand href="#">Forum MadDevs</Navbar.Brand>
            <Nav className="mr-auto"></Nav>
            <Nav>
              <Nav.Link href="#">Регистрация</Nav.Link>
              <Nav.Link href="#">Вход</Nav.Link>
              <Nav.Link href="#">Выход</Nav.Link>
            </Nav>
          </Container>
        </Navbar>
        <Container className="App-container">
          <Route path="/" exact component={HomeComponent} />
        </Container>
      </div>
    );
  }
}

export default AppComponent;
