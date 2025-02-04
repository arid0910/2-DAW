import { Component } from 'react'
import { Card, CardBody, CardText, CardTitle, Modal, ModalHeader, ModalBody, ModalFooter, Button } from 'reactstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

export const PIELES = [
  {
    id: 0,
    imagen: "https://pielparaartesanos.com/cdn/shop/files/Cabra_laminada_oro.jpg",
    nombre: "Cabra laminada oro",
    texto: "Cabra laminada con acabado arrugado en color oro"
  },
  {
    id: 1,
    imagen: "https://pielparaartesanos.com/cdn/shop/files/Vacuno_enecerado_lodo.jpg",
    nombre: "Vacuno encerado lodo",
    texto: "Dale un toque único y resistente a tus productos artesanales con este material de alta calidad"
  },
  {
    id: 2,
    imagen: "https://pielparaartesanos.com/cdn/shop/files/RST_420.jpg",
    nombre: "Vacuno flor burdeos",
    texto: "La piel vacuno es la opción ideal para los bolsos de calidad"
  }
];

function Producto(props) {
  return (
    <Card style={{ width: '18rem' }}>
      <img src={props.img} alt={props.nombre} />
      <CardBody>
        <CardTitle tag="h5">{props.nombre}</CardTitle>
        <CardText>{props.texto}</CardText>
        <Button color='primary' onClick={() => props.comprar(props.nombre, props.id)}>Comprar</Button>
      </CardBody>
    </Card>
  )
}

function ShowProductos(props) {
  let Productos = []
  for (let i = 0; i < props.liPro.length; i++) {
    Productos.push(<Producto img={props.liPro[i].imagen} nombre={props.liPro[i].nombre} texto={props.liPro[i].texto} comprar={(nombre, id) => props.comprar(nombre, id)} id={props.liPro[i].id} />)
  }
  return (
    <>
      {Productos.map(p => p)}
    </>

  )
}

const VentanaModal = (props) => {
  const { className } = props;

  return (
    <div>
      <Modal isOpen={props.mostrar} toggle={props.toggle} className={className}>
        <ModalHeader toggle={props.toggle}>CARRITO DE LA COMPRA</ModalHeader>
        <ModalBody>
          {props.carro.map(p => {
            return (<p>{p.nombre + " - " + p.numero} {"  "} {<Button onClick={() => props.resta(p.id)}>-</Button>}{<Button onClick={() => props.suma(p.id)}>+</Button>}</p>)
          })}
        </ModalBody>
        <ModalFooter>
          <Button color='primary' onClick={() => props.toggle()}>CERRAR</Button>
        </ModalFooter>
      </Modal>
    </div>
  )
}

class App extends Component {
  constructor(props) {
    super(props);

    this.state = {
      listaProductos: PIELES,
      isOpen: false,
      carrito: [],
    };
  }

  toggleModal() {
    this.setState({ isOpen: !this.state.isOpen })
  }

  Comprar(nombre, id) {
    let auxCarrito = this.state.carrito;

    let existe = auxCarrito.filter(p => p.id === id).length
    if (existe === 0) {
      let producto = { id: id, nombre: nombre, numero: 1 }
      auxCarrito.push(producto)
    } else {
      auxCarrito.map(p => {
        if (p.id === id) {
          p.numero += 1
        }
      })
    }

    this.setState({ carrito: auxCarrito })
  }

  suma(id){
    let auxCarrito = this.state.carrito;

    auxCarrito.map(p => {
      if(p.id === id){
        p.numero += 1
      }
    })

    this.setState({carrito : auxCarrito})
  }

  resta(id){
    let auxCarrito = this.state.carrito;

    auxCarrito.map(p => {
      if(p.id === id){
        if(p.numero > 0){
          p.numero -= 1
        } else {
          auxCarrito.filter(p => p.id !== id)
        }
      }
    })

    this.setState({carrito : auxCarrito})
  }

  render() {
    return (
      <>
        <Button color='primary' onClick={() => this.toggleModal()}>Carrito</Button>
        <ShowProductos liPro={this.state.listaProductos} comprar={(nombre, id) => this.Comprar(nombre, id)} />
        <VentanaModal
          mostrar={this.state.isOpen}
          toggle={() => this.toggleModal()}
          carro={this.state.carrito}
          resta={(id) => this.resta(id)}
          suma={(id) => this.suma(id)}
        />
      </>
    );
  }
}
export default App;