import { Component, useState, useEffect } from 'react'
import { Card, CardBody, CardText, CardTitle, Modal, ModalHeader, ModalBody, ModalFooter, Button, Input, Col, Label, FormGroup, Alert } from 'reactstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

export const PIELES = [
  {
    id: 0,
    imagen: "https://pielparaartesanos.com/cdn/shop/files/Cabra_laminada_oro.jpg",
    nombre: "Cabra laminada oro",
    texto: "Cabra laminada con acabado arrugado en color oro",
    precio: 12
  },
  {
    id: 1,
    imagen: "https://pielparaartesanos.com/cdn/shop/files/Vacuno_encerado_lodo.jpg",
    nombre: "Vacuno encerado lodo",
    texto: "Dale un toque único y resistente a tus productos artesanales con este material de alta calidad",
    precio: 15
  },
  {
    id: 2,
    imagen: "https://pielparaartesanos.com/cdn/shop/files/RST_420.jpg",
    nombre: "Vacuno flor burdeos",
    texto: "La piel vacuno es la opción ideal para los bolsos de calidad",
    precio: 22
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
    Productos.push(<Producto 
      img={props.liPro[i].imagen} 
      nombre={props.liPro[i].nombre} 
      texto={props.liPro[i].texto} 
      comprar={(nombre, id) => props.comprar(nombre, id)} 
      id={props.liPro[i].id} />)
  }
  return (
    <>
      {Productos.map(p => p)}
    </>

  )
}

const VentanaModal = (props) => {
  const { className } = props;

  const [nombre, setNombre] = useState()
  const [apellido, setApellido] = useState();
  const [telefono, setTelefono] = useState();
  const [direccion, setDireccion] = useState();

  const [verAlerta, setVerAlerta] = useState(false)
  const [msgAlerta, setmsgAlerta] = useState()
  const [colorAlerta, setcolorAlerta] = useState()

  const handleChange = (event) => {
    let target = event.target;

    if (target.name === "nombre") {
      setNombre(target.value)
    }

    if (target.name === "apellido") {
      setApellido(target.value)
    }

    if (target.name === "telefono") {
      setTelefono(target.value)
    }

    if (target.name === "direccion") {
      setDireccion(target.value)
    }
  }

  useEffect(() => {
    if (!props.mostrar) {
      setVerAlerta(false); 
      setmsgAlerta("");
    }
  }, [props.mostrar]);

  const pedir = (array, totalPro, totalPre) => {
    if (nombre === undefined || apellido === undefined || telefono === undefined || direccion === undefined) {
      setVerAlerta(true)
      setcolorAlerta("danger")
      setmsgAlerta('Campos vacios o erroneos')
    } else {
      let idPedido = array.length ? array[array.length - 1].id + 1 : 1;
      let infoPedido = <p>{"Pedido nº:"+idPedido+"  Pedido por: "+nombre+" "+apellido+ "  Productos: "+totalPro+"  Pecio: "+totalPre+ "€"}</p>
      array.push({id: idPedido , info: infoPedido})
      setVerAlerta(true)
      setcolorAlerta("primary")
      setmsgAlerta('Pedido hecho con exito')
    }
  }

  return (
    <div>
      <Modal isOpen={props.mostrar} toggle={props.toggle} className={className}>
        <ModalHeader toggle={props.toggle}>CARRITO DE LA COMPRA</ModalHeader>
        <ModalBody>
          {props.carro.map(p => {
            return (<p>{p.nombre + " - " + p.numero + " - " + p.precio + "€" } 
            {"  "} 
            {<Button onClick={() => props.resta(p.id, p.precio)}>-</Button>}
            {<Button onClick={() => props.suma(p.id, p.precio)}>+</Button>}</p>)
          })}
          {"Total: " + props.totalPrecio()+ "€"}
          <FormGroup row>
            <Label sm={2} > Nombre: </Label>
            <Col sm={10}>
              <Input onChange={handleChange}
                id="nombre"
                name="nombre"
                type="Text" />
            </Col>
          </FormGroup>
          <FormGroup row>
            <Label sm={2} > Apellido: </Label>
            <Col sm={10}>
              <Input onChange={handleChange}
                id="apellido"
                name="apellido"
                type="text" />
            </Col>
          </FormGroup>
          <FormGroup row>
            <Label sm={2} > Teléfono: </Label>
            <Col sm={10}>
              <Input onChange={handleChange}
                id="telefono"
                name="telefono"
                type="number" />
            </Col>
          </FormGroup>
          <FormGroup row>
            <Label sm={2} > Dirección: </Label>
            <Col sm={10}>
              <Input onChange={handleChange}
                id="direccion"
                name="direccion"
                type="text" />
            </Col>
          </FormGroup>
          <Alert isOpen={verAlerta} color={colorAlerta}>{msgAlerta}</Alert>
        </ModalBody>
        <ModalFooter>
          <Button color='primary' onClick={() => pedir(props.pedidos, props.totalProductos(), props.totalPrecio())}>PEDIR</Button>
          <Button color='primary' onClick={() => props.toggle()}>CERRAR</Button>
        </ModalFooter>
      </Modal>
    </div>
  )
}

const VentanaModalPedidos = (props) => {
  const { className } = props;

  return (
    <Modal isOpen={props.mostrar} toggle={props.toggle} className={className}>
      <ModalHeader toggle={props.toggle}>HISTORIAL DE PEDIDOS</ModalHeader>
      <ModalBody>
        {props.pedidos.map(p => p.info)}
      </ModalBody>
      <ModalFooter>
        <Button color='primary' onClick={() => props.toggle()}>CERRAR</Button>
      </ModalFooter>
    </Modal>
  )
}

class App extends Component {
  constructor(props) {
    super(props);

    this.state = {
      listaProductos: PIELES,
      carrito: [],
      pedidos: []
    };
  }

  toggleModal() {
    this.setState({isOpen: !this.state.isOpen})
  }

  toggleModal2() {
    this.setState({ isOpen2: !this.state.isOpen2 })
  }

  Comprar(nombre, id) {
    let auxCarrito = this.state.carrito;
    let precio = this.state.listaProductos.find(p => p.id === id).precio

    let existe = auxCarrito.filter(p => p.id === id).length
    if (existe === 0) {
      let producto = { id: id, nombre: nombre, numero: 1, precio: precio}
      auxCarrito.push(producto)
    } else {
      auxCarrito.map(p => {
        if (p.id === id) {
          p.numero += 1
          p.precio += precio
          console.log(precio)
          console.log(p.precio)
        }
      })
    }

    this.setState({ carrito: auxCarrito })
  }

  suma(id) {
    let auxCarrito = this.state.carrito;
    let precio = this.state.listaProductos.find(p => p.id === id).precio

    auxCarrito.map(p => {
      if (p.id === id) {
        p.numero += 1
        p.precio += precio
      }
    })

    this.setState({ carrito: auxCarrito })
  }

  resta(id) {
    let auxCarrito = this.state.carrito;
    let precio = this.state.listaProductos.find(p => p.id === id).precio

    auxCarrito = auxCarrito.map(p => {
      if (p.id === id) {
        if (p.numero > 0) {
          p.numero -= 1;
          p.precio -= precio
        }
        if (p.numero === 0) {
          return null;
        }
      }
      return p;
    }).filter(p => p !== null);

    this.setState({ carrito: auxCarrito });
  }

  totalEnCarrito() {
    let total = 0;

    this.state.carrito.map(p => {
      total += p.numero
    })

    return (total)
  }

  totalPrecio(){
    let total = 0;

    this.state.carrito.map(p => {
      total += p.precio
   })

   return(total)
  }

  render() {
    return (
      <>
        <Button color='primary' onClick={() => this.toggleModal()}>Carrito({this.totalEnCarrito()})</Button>
        <Button color='primary' onClick={() => this.toggleModal2()}>Pedidos</Button>
        <ShowProductos liPro={this.state.listaProductos} comprar={(nombre, id) => this.Comprar(nombre, id)} />
        <VentanaModal
          mostrar={this.state.isOpen}
          toggle={() => this.toggleModal()}
          carro={this.state.carrito}
          resta={(id) => this.resta(id)}
          suma={(id) => this.suma(id)}
          pedidos={this.state.pedidos}
          totalProductos={() => this.totalEnCarrito()}
          totalPrecio={() => this.totalPrecio()}
        />

        <VentanaModalPedidos
          mostrar={this.state.isOpen2}
          toggle={() => this.toggleModal2()}
          pedidos={this.state.pedidos}
        />
      </>
    );
  }
}
export default App;