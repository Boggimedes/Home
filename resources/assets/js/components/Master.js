// Master.js

import React, {Component} from 'react';
import { BrowserRouter, Router, Route, NavLink, Switch, Redirect } from 'react-router-dom';
import Home from './Home';
import Profile from './Profile';
import Coffees from './Coffees';
import EditItem from './EditItem';

class Master extends Component {


  componentWillMount() {
      this.setState({
        username: "",
        fullname: "",
        userId: null,
        drinks: []
      });
  };

  updateUser() {

  };

  addDrink() {

  };

  getDrinks() {

  };

  handleUsername(username) {
var transitionTo = Router.transitionTo;
          console.log(username);

    const user = {
      username: username
    }
    let uri = '/api/user';
    axios.post(uri, user)      
        .then(response => {
          console.log(Redirect);
          this.setState({ username: response.data.username, id: response.data.id });
          transitionTo(`/coffee-tracker/${response.data.username}/profile`);
        })
        .catch(error => {
          console.log(error);
        });
  };

  render(){
    return (
<div className="flex-center position-ref full-height">
<nav className="navbar navbar-inverse">
  <div className="container-fluid">
    <div className="navbar-header">
      <button aria-expanded="false" className="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" type="button">
        <span className="sr-only">Toggle navigation</span>
        <span className="icon-bar"></span>
        <span className="icon-bar"></span>
        <span className="icon-bar"></span>
      </button>
      <NavLink className="navbar-brand" to="/coffee-tracker">
          Coffee Counter
          </NavLink>
    </div>

    <div className="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul className="nav navbar-nav">
<li><NavLink to={`/coffee-tracker/${this.state.username}/profile/"`} activeClassName="active">Profile</NavLink></li>
<li><NavLink to={`/coffee-tracker/${this.state.username}/coffees/"`} activeClassName="active">Coffees</NavLink></li>
      </ul>
    </div>
  </div>
</nav>
<div className="jumbotron">
<div  className="container">
  <Switch>
        <Route exact path="/coffee-tracker" render={(props) => (<Home handleUsername={this.handleUsername} />)} />
        <Route path="/coffee-tracker/:username/profile" render={(props) => (<Profile username={this.state.username} />)} />
        <Route path="/coffee-tracker/:username/coffees" render={(props) => (<Coffees username={this.state.username} />)} />
    </Switch>
        </div>
        </div>
    </div>    
    )
  }
}
export default Master;

