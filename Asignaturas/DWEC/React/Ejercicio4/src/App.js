import React, { Component } from 'react';
import UserList from './Components/UserList';
import UserForm from './Components/UserForm';

class App extends Component {
  constructor() {
    super();
    this.state = {
      users: [
        { id: 1, name: "perico", email: "perico@myfpschool.com" },
        { id: 2, name: "juanico", email: "juanico@myfpschool.com" },
        { id: 3, name: "andrés", email: "andrés@myfpschool.com" }
      ]
    };
  }

  handleOnAddUser(event) {
    event.preventDefault();

    let user = {
      id: Math.max(...this.state.users.map(x => x.id)) + 1,
      name: event.target.name.value,
      email: event.target.email.value
    };

    let tmp = this.state.users;

    if (!tmp.find(n => n.email === user.email)) {
      tmp.push(user);

      this.setState({
        users: tmp
      });
    } else {
      alert("Ya existe este email")
    }
  }

  render() {
    return (
      <div className="App">

        <div className="App-header">
          <h2>Me mola Myfpschool</h2>
        </div>

        <div>
          <p><strong>Añade usuarios</strong></p>
          <UserList users={this.state.users} />
          <UserForm onAddUser={(e) => this.handleOnAddUser(e)} />
        </div>

      </div>
    );
  }
}
export default App;