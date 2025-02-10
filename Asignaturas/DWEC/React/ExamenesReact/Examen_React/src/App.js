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

  const validarDatos = () => {
    if (nombre === undefined || apellido === undefined || telefono === undefined || direccion === undefined) {
      setVerAlerta(true)
      setcolorAlerta("danger")
      setmsgAlerta('Campos vacios o erroneos')
    } else if (props.carro.length < 1) {
      setVerAlerta(true)
      setcolorAlerta("warning")
      setmsgAlerta('Carrito vacio!!')
    } else {
      props.pedir()
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
            return (<p>{p.nombre + " - " + p.cantidad + " - " + p.precio + "€"}
              {"  "}
              {<Button onClick={() => props.resta(p.id, p.precio)}>-</Button>}
              {<Button onClick={() => props.suma(p.id, p.precio)}>+</Button>}</p>)
          })}
          {"Total: " + props.totalPrecio() + "€"}
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
          <Button color='primary' onClick={() => validarDatos()}>PEDIR</Button>
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
      <ModalHeader toggle={props.toggle}>📦 HISTORIAL DE PEDIDOS</ModalHeader>
      <ModalBody>
        {(props.pedidos.map((pe) => (
            <Card key={pe.id}>
              <CardBody>
                <CardTitle tag="h5">🛒 Pedido #{pe.id}</CardTitle>
                <p><strong>Productos:</strong></p>
                <ul>
                  {pe.productos.map((prod, index) => (
                    <li key={index}>
                      <div>
                        <strong>{prod.nombre}</strong> <br />
                        Cantidad: {prod.cantidad} - {prod.precio}€
                      </div>
                      <img src={prod.imagen} alt={prod.nombre} width="50" />
                    </li>
                  ))}
                </ul>
                <p><strong>Total:</strong>{pe.precioTotal}€</p>
              </CardBody>
            </Card>
          ))
        )}
      </ModalBody>
      <ModalFooter>
        <Button color="secondary" onClick={props.toggle}>Cerrar</Button>
      </ModalFooter>
    </Modal>
  );
};



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
    this.setState({ isOpen: !this.state.isOpen })
  }

  toggleModal2() {
    this.setState({ isOpen2: !this.state.isOpen2 })
  }

  pedir() {
    let auxPedidos = this.state.pedidos
    let auxCarrito = this.state.carrito
    let idPedido = auxPedidos.length ? auxPedidos[auxPedidos.length - 1].id + 1 : 1;
    let productosPedido = []

    auxCarrito.map(p => {
      if (p.cantidad > 0) {
        productosPedido.push(p)
      }
    })

    auxPedidos.push({ id: idPedido, productos: productosPedido, precioTotal: this.totalPrecio() })

    this.setState({ pedidos: auxPedidos })

    console.log(this.state.pedidos)

    this.vaciarCarrito()
  }

  Comprar(nombre, id) {
    let auxCarrito = this.state.carrito;
    let precio = this.state.listaProductos.find(p => p.id === id).precio
    let img = this.state.listaProductos.find(p => p.id === id).imagen

    let existe = auxCarrito.filter(p => p.id === id).length
    if (existe === 0) {
      let producto = { id: id, nombre: nombre, cantidad: 1, precio: precio, imagen:img }
      auxCarrito.push(producto)
    } else {
      auxCarrito.map(p => {
        if (p.id === id) {
          p.cantidad += 1
          p.precio += precio
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
        p.cantidad += 1
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
        if (p.cantidad > 0) {
          p.cantidad -= 1;
          p.precio -= precio
        }
        if (p.cantidad === 0) {
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
      total += p.cantidad
    })

    return (total)
  }

  totalPrecio() {
    let total = 0;

    this.state.carrito.map(p => {
      total += p.precio
    })

    return (total)
  }

  vaciarCarrito() {
    this.setState({ carrito: [] });
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
          totalPrecio={() => this.totalPrecio()}
          pedir={() => this.pedir()}
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