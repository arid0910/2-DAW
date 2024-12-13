import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Alert, Button } from 'reactstrap';
import { Component } from 'react';

class App extends Component {
  constructor(props) {
    super(props);

    this.state = {
      visibilidadAlerta: false,
      mensajeAlerta: '',
      colorAlerta: '',
    };
  }

  verAlerta(color, message) {
    this.setState({
      visibilidadAlerta: true,
      mensajeAlerta: message,
      colorAlerta: color,
    });
  }

  cerrarAlerta = () => {
    this.setState({ visibilidadAlerta: false });
  };

  render() {
    return (
      <div className="App">
        {this.state.visibilidadAlerta && (<Alert color={this.state.colorAlerta} toggle={this.cerrarAlerta}>{this.state.mensajeAlerta}</Alert>)}
        <Button color="primary" onClick={() => this.verAlerta('primary', 'Botón Azul')}>Botón Azul</Button>
        <Button color="danger" onClick={() => this.verAlerta('danger', 'Botón Rojo')}>Botón Rojo</Button>
      </div>
    );
  }
}

export default App;
