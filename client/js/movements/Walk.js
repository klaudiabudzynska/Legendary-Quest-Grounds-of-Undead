import { Movement } from '../Character.js';
import { Vector, Matrix } from '../math.js';
import TileCollider from '../TileCollider.js';
import Level from '../Level.js';
import { getTilesMatrix } from '../loaders.js';

export default class Walk extends Movement {
    constructor() {
        super('walk');

        this.dest = new Vector(0, 0);
        this.map = getTilesMatrix()
        this.tileCollider = new TileCollider(this.map);
    }

    start(destPos) {
        //jeśli nie zaszła kolizja
        if (!this.tileCollider.test(destPos)) {
            this.dest.set(destPos.x, destPos.y);
        }
    }

    update(character, deltaTime) {
        if ((this.dest.x !== character.pos.x || 
            this.dest.y !== character.pos.y) && 
            this.canMove(character.pos, this.dest, character)) {
            const path = this.astar(character.pos, this.dest);
            console.log(path);
            character.pos.x = this.dest.x;
            character.pos.y = this.dest.y;
        }
    }

    canMove(start, end, character){
        return (
            Math.abs(start.x - end.x) <= character.range && 
            Math.abs(start.y - end.y) <= character.range
        );
    }

    astar(start, end) {
        let openSet = [];
        let closedSet = [];
        openSet.push([[start]]);
        closedSet.push(start);
        console.log(start, end);

        for(let i = 0; i < 3; ++i){
            //tablica na kolejną iterację 
            openSet.push([]);
            openSet[i].forEach((currentPath, j) => {
                console.log(currentPath);
                let neighbours = this.neighbours(currentPath[currentPath.length - 1])
                neighbours.forEach(neighbour => {
                    //tablica na ścieżki z kontynuacją ściezki z poprzedniej iteracji
                    openSet[i + 1].push(currentPath);
                    if(!this.tileCollider.test(neighbour) && currentPath.indexOf(neighbour) === -1){
                        openSet[i + 1][j].push(neighbour);
                    }
                });
                // closedSet.push(this.heuristics(openSet[i + 1], end));
            })
        }
        console.log(openSet);
        return closedSet;
    };
    neighbours(pos){
        const neighbours = [];
        if(pos.x < this.map.grid.length - 1){
            neighbours.push(new Vector(pos.x + 1, pos.y));
        }
        if(pos.x > 0){
            neighbours.push(new Vector(pos.x - 1, pos.y));
        }
        if(pos.y < this.map.grid.length - 1){
            neighbours.push(new Vector(pos.x, pos.y + 1));
        }
        if(pos.y > 0){
            neighbours.push(new Vector(pos.x, pos.y - 1));
        }
        return neighbours;
    }
}