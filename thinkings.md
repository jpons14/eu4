# DB

## Tables 
- Users
- Planets
- buildings
- Solar Systems
- Galaxies (1)

## Strucutures
One user can have from 1 to 5 plants 
On new user this one will only have 1 planet

1 Planet has 8 resources
- titanium
- copper
- iron
- aluminium
- silicon
- uranium
- nitrogen
- hydrogen

1 planet can have from 5% to 100% percent of each resource
1 solar system can have from 5 to 8 planets
each planet has a direccion inside the solar system x:y
each solar system has a direccion x:y

1 user can have 0 or many ships
1 ship can only belongs to 1 user

1 ship has 2 speed multipier
- NormalSpeed
- WrapSpeed

1 ship has a solar sytem x:y location (nullable) and a galaxy x:y location (nullable)

if both (4) are null (or all are null or all are filled) means that the ship is on the planet


## How will factories work
1 planet has 8 factories
(60 per minute * 60 per minute ) = 3600  --- para hacer numeros redondos
each factory will produce per hour ((60 * 60) * 0.$planetPercentage) * $factoryLevel
