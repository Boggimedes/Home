// DisplayItem.js

import React, {Component} from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';
import TableRow from './TableRow';

class Coffees extends Component {

     componentDidMount(){
      axios.post('/drinks', {
          userId: this.state.userId
        })
        .then(response => {
          console.log(response);
          this.setState({ drinks: response.data });
        })
        .catch(error => {
          console.log(error);
        });
       // axios.get('/drinks')
       // .then(response => {
       //   this.setState({ items: response.data });
       // })
       // .catch(function (error) {
       //   console.log(error);
       // })
     }
     tabRow(){
      return;
       if(this.state.items instanceof Array){
         return this.state.items.map(function(object, i){
             return <TableRow obj={object} key={i} />;
         })
       }
     }

  render(){
    return (
      <div>
        <h1>Items</h1>

        <div className="row">
          <div className="col-md-10"></div>
          <div className="col-md-2">
            <Link to="/add-item">Create Item</Link>
          </div>
        </div><br />

        <table className="table table-hover">
            <thead>
            <tr>
                <td>ID</td>
                <td>Item Name</td>
                <td>Item Price</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
              {this.tabRow()}
            </tbody>
        </table>
    </div>
    )
  }
}
export default Coffees;