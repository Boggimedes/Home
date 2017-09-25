import React, { Component } from 'react';
import { Route, NavLink, Switch, withRouter } from 'react-router-dom';
import axios from 'axios';
import Home from './Home';
import Profile from './Profile';
import Coffees from './Coffees';
import { Navbar, Nav, Jumbotron } from 'react-bootstrap';

class Master extends Component {
    state = {
        user: {
            username: "",
            fullname: "",
            id: null,
            drinks: []
        }
    };
    checkUser = (username) => {
        if (this.state.user.id == null) 
          this.handleUsername(username);
    };
    addDrink = (drinkName) => {
        let uri = '/api/drink';
        const drink = {
            name: drinkName,
            userId: this.state.user.id
        };
        axios.post(uri, drink).then(response => {
            let drinks = this.state.user.drinks;
            drinks.push(response.data);
            let user = this.state.user;
            user.drinks = drinks;
            this.setState({
                user: user
            });
        })
    }
    handleDelete = (id) => {
        let uri = `/api/drink/${id}`;
        let drinks = this.state.user.drinks;
        let user = this.state.user;
        axios.delete(uri);
        drinks = drinks.filter((drink) => drink.id !== id);
        user.drinks = drinks;
        this.setState({
            user: user
        });
    }
    handleFullname = (fullname) => {
        const user = {
            username: this.state.user.username,
            fullname: fullname
        }
        let uri = '/api/user/' + this.state.user.id;
        axios.put(uri, user)
          .then(response => {
            let user = this.state.user;
            user.fullname = fullname;
            this.setState({
                user: user
            });
          })
          .catch(error => {
            console.log(error);
          });
    };
    handleUsername = (username) => {
        const user = {
            username: username
        };
        let uri = '/api/user';
        let loc = this.props.location.pathname;
        axios.post(uri, user).then(response => {
            this.setState({
                user: {
                    username: response.data.username,
                    id: response.data.id,
                    fullname: response.data.fullname,
                    drinks: []
                }
            });
            axios.get(`/api/drink?userId=${response.data.id}`)
              .then(response => {
                let user = this.state.user;
                user.drinks = response.data;
                this.setState({
                    user: user
                });
                if (loc.replace(/\/$/, "") === '/coffee-tracker') {
                  if (typeof user.fullname === 'undefined' || user.fullname === '') this.props.history.push(`/coffee-tracker/${this.state.user.username}/profile`);
                  else this.props.history.push(`/coffee-tracker/${this.state.user.username}/coffees`);
                }
            }).catch(error => {
                console.log(error);
            });
        })
    };
    render() {
      return (
        <div className="flex-center position-ref full-height">
          <Navbar inverse collapseOnSelect>
            <Navbar.Header>
              <Navbar.Brand>
                <NavLink className="navbar-brand" to="/coffee-tracker">
                  Coffee Counter
                </NavLink>
              </Navbar.Brand>
              <Navbar.Toggle />
            </Navbar.Header>
            <Navbar.Collapse>
              <Nav>
              <li><NavLink className={this.state.user.username ? '' : 'hidden'} eventKey={1} to={`/coffee-tracker/${this.state.user.username}/profile/`}>Profile</NavLink></li>
              <li><NavLink className={this.state.user.username ? '' : 'hidden'} eventKey={2} to={`/coffee-tracker/${this.state.user.username}/coffees/`}>Coffees</NavLink></li>
              </Nav>
            </Navbar.Collapse>
          </Navbar>

          <Jumbotron>
            <div className="container">
              <Switch>
                <Route exact path="/coffee-tracker" render={(props) => (<Home handleUsername={this.handleUsername} />)} />
                <Route path="/coffee-tracker/:username/profile" render={(props) => (
                  <Profile 
                    handleFullname={this.handleFullname}
                    user={this.state.user}
                    checkUser={this.checkUser}
                    {...props}
                  />
                )} />
                <Route path="/coffee-tracker/:username/coffees" render={(props) => (
                  <Coffees 
                    user={this.state.user} 
                    checkUser={this.checkUser}
                    handleDelete={this.handleDelete}
                    addDrink={this.addDrink}
                    {...props} 
                  />
                )} />
              </Switch>
            </div>
          </Jumbotron>    
        </div>
      )
    }
  }
export default withRouter(Master);