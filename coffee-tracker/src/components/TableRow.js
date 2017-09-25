import React, { Component } from 'react';

class TableRow extends Component {
  render() {
    return (
        <tr>
          <td>
            {this.props.obj.name}
          </td>
          <td>
            {this.props.obj.created_at}
          </td>
          <td>
            <button onClick={() => this.props.handleDelete(this.props.obj.id)} className="btn btn-primary">Delete</button>
          </td>
        </tr>
    );
  }
}
export default TableRow;