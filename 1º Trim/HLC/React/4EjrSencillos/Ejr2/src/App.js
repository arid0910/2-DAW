import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Button, Modal, ModalHeader, ModalBody, ModalFooter } from 'reactstrap';
import { Component } from 'react'

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      visibilidadVenta: false,
      mensajeVenta: '',
      tituloVenta: '',
    }
  }

  verVentana(titulo, mensaje) {
    this.setState({
      visibilidadVenta: true,
      mensajeVenta: mensaje,
      tituloVenta: titulo
    })
  }

  cerrarVentana = () => {
    this.setState({
      visibilidadVenta: false,
    });
  };

  render() {
    return (
      <div className="App">
        <Button color='danger' onClick={() => this.verVentana("Ventana Modal 123", "Hola esta es una ventana modal muy chula")}>Click Me!!</Button>
        
        <Modal isOpen={this.state.visibilidadVenta}>
          <ModalHeader>
            {this.state.tituloVenta}
          </ModalHeader>
          <ModalBody>
            {this.state.mensajeVenta}
          </ModalBody>
          <ModalFooter>
            <Button color="primary" onClick={this.cerrarVentana}>Cerrar</Button>
          </ModalFooter>
        </Modal>
      </div>
    );
  }
}
export default App;